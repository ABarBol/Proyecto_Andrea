<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    props: ['events'],
    components: {
        FullCalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                dateClick: this.handleDateClick,
                events: this.events,
                eventClick: this.handleEventClick
            }
        }
    },
    methods: {
        handleEventClick: function (info) {
            alert('Titulo: ' + info.event.title)
        }
    }
}
</script>
<template>
    <FullCalendar :options="calendarOptions" />
</template>