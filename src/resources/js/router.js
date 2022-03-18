import Vue from "vue";
import VueRouter from "vue-router";

// ページコンポーネントをインポートする
import PhotoList from "./components/pages/PhotoList.vue";
import Login from "./components/pages/Login.vue";
import store from "./store";
import SystemError from "./components/pages/errors/System.vue";
import NotFound from "./components/pages/errors/NotFound.vue";
import PhotoDetail from "./components/pages/PhotoDetail.vue";

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter);

// パスとコンポーネントのマッピング
const routes = [{
        path: "/",
        component: PhotoList,
        props: (route) => {
            const page = route.query.page;
            return { page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1 };
        },
    },
    {
        path: "/login",
        component: Login,
        beforeEnter(to, from, next) {
            if (store.getters["auth/check"]) {
                next("/");
            } else {
                next();
            }
        },
    },
    {
        path: "/photos/:id",
        component: PhotoDetail,
        props: {
            id: {
                type: String,
                required: true,
            },
        },
    },
    {
        path: "/500",
        component: SystemError,
    },
    {
        path: "*",
        component: NotFound,
    },
];

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: "history",
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    routes,
});

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router;