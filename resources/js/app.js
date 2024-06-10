/**
 * Load css from css folder
 */

import '../css/app.css';

/**
 * Create a new Vue application.
 */
import { createApp } from "vue";


/**
 * Import the Calendar component with Full-Calendar JavaScript Calendar
 */
import CalendarComponent from "./components/CalendarComponent.vue";

/**
 * Mount Vue app with components
 */
const app = createApp({});

app.component("calendarcomponent", CalendarComponent);

const mountedApp = app.mount("#app");