import './bootstrap';
import '../css/app.css';

import { createApp } from "vue";

import CalendarComponent from "./components/CalendarComponent.vue";

const app = createApp({});

app.component("calendarcomponent", CalendarComponent);

const mountedApp = app.mount("#app");