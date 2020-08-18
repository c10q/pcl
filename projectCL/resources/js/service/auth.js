import { http } from './http'
import jwt from 'jsonwebtoken'

export function register(user) {
    return http().post('/auth/register', user)
}

export function login(user) {
    return http().post('/auth/login', user)
        .then((res) => {
            if (res.status === 200) {
                setToken(res.data);
            }
        })
}

function setToken(user) {
    const token = jwt.sign({user: user}, 'projectcloqdifihwvjsdnakjbddvjeo2020')
    localStorage.setItem('project-cloq-token', token)
}

export function isLoggedIn() {
    if(!localStorage.getItem('project-cloq-token')) return null
    const token = localStorage.getItem('project-cloq-token');
    return token != null
}

export function admin() {

    if(!localStorage.getItem('project-cloq-token')) return null

    return jwt.decode(localStorage.getItem('project-cloq-token')).user.user.role === 'administrator';
}

export function logout() {
    http().get('/auth/logout');
    localStorage.removeItem('project-cloq-token');
    window.location.reload()
}

export function getAccessToken() {
    const token = localStorage.getItem('project-cloq-token');
    if(!token) {
        return null;
    }

    const tokenData = jwt.decode(token);
    return tokenData.user.access_token;

}
