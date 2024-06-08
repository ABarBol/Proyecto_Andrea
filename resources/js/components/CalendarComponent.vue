<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import { diffDates } from '@fullcalendar/core/internal';

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
                eventClick: function (info) {
                    $("#myModal").modal("show");
                    $("#title").text(info.event.title);
                    $("#description").text(info.event.extendedProps.description);
                    $("#start").text(info.event.start.toLocaleDateString());
                    $("#end").text(info.event.end.toLocaleDateString());
                },
            },

        }
    },
    methods: {
        closeModal() {
            $('#myModal').modal('hide'); // Esto es jQuery, asegúrate de que jQuery está correctamente integrado
        }
    }
}
</script>
<template>
    <FullCalendar :options="calendarOptions" />
    <div class="modal fade bd-example-modal-lg" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h4 id="title" class="modal-title"></h4>
                    <small class="modal-title"><i class="fa-solid fa-clock"></i> <span id="start"></span> <i class="fa-solid fa-arrow-right"></i> <span id="end"></span></small>
                </div>
                <div id="description" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="closeModal">Close</button>
                </div>
            </div>

        </div>
    </div>
</template>