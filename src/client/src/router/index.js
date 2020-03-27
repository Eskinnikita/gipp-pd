import Vue from 'vue'
import VueRouter from 'vue-router'
import NewsFeed from "../views/NewsFeed"
import Admin from "../views/Admin/Admin"
import ArticleEditor from "../views/Admin/ArticleEditor"
import Login from "../views/Admin/Login"
import ArticleView from "../views/ArticleView"

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'RubricFeed',
        component: NewsFeed
    },
    {
        path: '/rubric/:name',
        name: 'RubricFeed',
        props: true,
        component: NewsFeed
    },
    {
        path: '/admin',
        name: 'Admin',
        component: Admin
    },
    {
        path: '/article-editor',
        name: 'ArticleEditor',
        component: ArticleEditor
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/news/:id',
        name: 'ArticleView',
        component: ArticleView
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
