import Vue from 'vue'
import VueRouter from 'vue-router'
import NewsFeed from "../views/NewsFeed"
import Admin from "../views/Admin/Admin"
import ArticleEditor from "../views/Admin/Articles/ArticleEditor"
import Login from "../views/Admin/Login"
import ArticleView from "../views/ArticleView"
import NotFound from "../views/NotFound"
import PageEdit from "../views/Admin/PageEdit"

Vue.use(VueRouter)


const routes = [
    {
        path: '/',
        name: 'RubricFeed',
        component: NewsFeed,
        meta: {
            title: 'Главное'
        }

    },
    {
        path: '/rubric/:name',
        name: 'RubricFeed',
        props: true,
        component: NewsFeed,
        meta: {
            title: 'Рубрика'
        }
    },
    {
        path: '/admin',
        name: 'Admin',
        component: Admin,
        meta: {
            title: 'Панель администратора'
        }
    },
    {
        path: '/article-editor',
        name: 'ArticleEditor',
        component: ArticleEditor,
        meta: {
            title: 'Редактор'
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            title: 'Войдите'
        }
    },
    {
        path: '/news/:id',
        name: 'ArticleView',
        component: ArticleView
    },
    {
        path: '/edit-page',
        name: 'PageEdit',
        component: PageEdit,
        meta: {
            title: 'Редактор'
        }
    },
    {
        path: '/404',
        name: '404',
        component: NotFound,
        meta: {
            title: 'Страница не найдена'
        }
    },
    {
        path: '*',
        redirect: '/404',
        meta: {
            title: 'Страница не найдена'
        }
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    next()
})

export default router
