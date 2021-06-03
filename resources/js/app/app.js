import { createApp } from 'vue';
import { createRouter, createWebHashHistory } from 'vue-router';
import App from './App';

import store from './store/store';

const Settings = () => import(/* webpackChunkName: "1" */ './views/GameSettings')
const WhoBegins = () => import(/* webpackChunkName: "2" */ './views/WhoBegins')
const Game = () => import(/* webpackChunkName: "3" */ './views/ScoreBoard')
const Win = () => import(/* webpackChunkName: "4" */ './views/Win')

// 2. Define some routes
// Each route should map to a component.
// We'll talk about nested routes later.
const routes = [
  { path: '/', component: Settings },
  { path: '/2', component: WhoBegins },
  { path: '/3', component: Game },
  { path: '/4', component: Win },
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = createRouter({
  // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
  history: createWebHashHistory(),
  routes, // short for `routes: routes`
})

router.beforeEach((to, from) => {
  	if (to.path == '/4' && from.path == '/')
		return false;

	if (to.path == '/3' && from.path == '/4')
		return false
  	
	return true
})

const app = createApp(App);
app.use(router)
app.use(store);
app.mount('#app');
