import Api from './Api.js';

const Report = {
    forProject: (project, options) => {
        return Api.get('/projects/' + project.id + '/reports', { params: {
            page: options.page || 1,
            perPage: options.perPage || 0
        }});
    }
};

export default Report;
