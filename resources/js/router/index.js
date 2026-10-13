import { createRouter, createWebHistory } from "vue-router";

import Calendar from "../components/Calendar.vue";
import Dashboard from "../components/Dashboard.vue";
import FinishJourneys from "../components/FinishJourneys.vue";
import Journey from "../components/Journey.vue";
import Journeys from "../components/Journeys.vue";
import Map from "../components/Map.vue";
import PlansJourneys from "../components/PlansJourneys.vue";

const routes = [

  {
    path: "/api/dashboard",
    component: Dashboard,
  },
  {
    path: "/calendar",
    component: Calendar,
  },
  {
    path: "/plansJourneys",
    component: PlansJourneys,
  },
  {
    path: "/finishJourneys",
    component: FinishJourneys,
  },
  {
    path: "/map",
    component: Map,
  },
  {
    path: "/journeys",
    component: Journeys,
  },
  {
    path: "/journeys/:slug",
    component: Journey,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
