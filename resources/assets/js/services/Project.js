import Api from './Api.js';

const Project = {
    my: () => {
        return Api.get('/projects/available');
    }
};

export default Project;
