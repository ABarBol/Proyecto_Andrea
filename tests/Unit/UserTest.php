<?php

namespace Tests\Unit;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * An authenticated user can view his own profile
     *
     * @return void
     */
    public function testUserCanSeeOwnProfile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('users.show', $user));

        $response->assertStatus(200);
    }

    /**
     * An authenticated user cannot view another user's profile. It redirects you to the list of users.
     *
     * @return void
     */
    public function testUserCantSeeAnotherProfile()
    {
        $user = User::factory()->create();
        $another_user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('users.show', $another_user));

        $response->assertRedirect(route('users.index'));
    }

    /**
     * An authenticated admin can view another user's profile.
     *
     * @return void
     */
    public function testAdminCanSeeAnyProfile()
    {
        $admin = User::factory()->create(['admin' => true]);
        $another_user = User::factory()->create();

        $response = $this->actingAs($admin)->get(route('users.show', $another_user));

        $response->assertStatus(200);
    }

    /**
     * Check that a user can register and redirect them to their profile.
     *
     * @return void
     */
    public function testUserCanRegister()
    {
        $formData = [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => $this->generatePassword(),
        ];

        $response = $this->post(route('register'), $formData);

        $this->assertDatabaseHas('users', [
            'email' => $formData['email'],
        ]);

        $this->assertAuthenticated();

        $user = User::where('email', $formData['email'])->first();
        $response->assertRedirect(route('users.show', $user));
    }

    /**
     * Check that a user can register and is redirected to their profile.
     *
     * @return void
     */
    public function testUserCanLogin()
    {
        $password = $this->generatePassword();

        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('users.show', $user));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Check that a user can register and is redirected to their profile.
     *
     * @return void
     */
    public function testWrongUserCantLogin()
    {

        $user = User::factory()->create([
            'email' => 'realuser@example.com',
            'password' => $this->generatePassword(),
        ]);

        $response = $this->post('/login', [
            'email' => 'realuser@example.com',
            'password' => $this->generatePassword(),
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
    }



    /**
     * The user can see the groups to which he belongs.
     *
     * @return void
     */
    public function testUserCanViewTheirGroups()
    {
        $group = Group::factory()->create();

        $user = User::factory()->create();;

        $user->groups()->attach($group);

        $response = $this->actingAs($user)->get(route('groups.show', $group));

        $response->assertStatus(200);
    }

    /**
     * The user cannot see groups to which he does not belong.
     *
     * @return void
     */
    public function testUserCantViewForeignGroups()
    {
        $group = Group::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('groups.show', $group));

        $response->assertRedirect(route('users.show', $user));
    }

    /**
     * The admin can see any group
     *
     * @return void
     */
    public function testAdminCantViewAnyGroup()
    {
        $group = Group::factory()->create();

        $user = User::factory()->create(['admin' => true]);

        $response = $this->actingAs($user)->get(route('groups.show', $group));

        $response->assertStatus(200);
    }


    /**
     * Generate a password that has at least one uppercase letter, 
     * one lowercase letter, one symbol and is at least 7 characters long.
     *
     * @return void
     */
    private function generatePassword()
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{7,}$/';

        do {
            $password = fake()->password(7);
        } while (!preg_match($pattern, $password));

        return $password;
    }
}
