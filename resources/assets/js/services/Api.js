import axios from 'axios';

const Api = axios.create({
    baseURL: '/webapi'
});

export default Api;
