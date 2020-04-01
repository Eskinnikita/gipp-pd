import Vue from 'vue'
import VueRouter from 'vue-router'
import NewsFeed from "../views/NewsFeed"
import Admin from "../views/Admin/Admin"
import ArticleEditor from "../views/Admin/Articles/ArticleEditor"
import Login from "../views/Admin/Login"
import ArticleView from "../views/ArticleView"
import NotFound from "../views/NotFound"
import PageEdit from "../views/Admin/PageEdit"
import ArticlePreview from "../views/Admin/Articles/ArticlePreview"

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
    },
    {
        path: '/edit-page',
        name: 'PageEdit',
        component: PageEdit
    },
    {
        path: '/article-preview',
        name: 'ArticlePreview',
        component: ArticlePreview
    },
    {
        path: '/404',
        name: '404',
        component: NotFound,
    }, {
        path: '*',
        redirect: '/404'
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
