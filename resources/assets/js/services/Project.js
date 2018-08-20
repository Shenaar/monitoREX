import Api from './Api.js';

const Project = {
    my: () => {
        return Api.get('/projects/owned');
    }
};

export default Project;
