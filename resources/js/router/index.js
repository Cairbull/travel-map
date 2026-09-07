import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "../components/Dashboard.vue";
import Calendar from "../components/Calendar.vue";
import Map from "../components/Map.vue";
import Journeys from "../components/Journeys.vue";
import PlansJourneys from "../components/PlansJourneys.vue";
import FinishJourneys from "../components/FinishJourneys.vue";
import Journey from "../components/Journey.vue";

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
