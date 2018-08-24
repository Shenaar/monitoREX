import Api from './Api.js';

const Report = {
    forProject: (project, options) => {
        return Api.get(`/projects/${project.id}/reports`, { params: {
            page: options.page || 1,
            perPage: options.perPage || 0
        }});
    },
    get: (projectId, reportId) => {
        return Api.get(`/projects/${projectId}/reports/${reportId}`);
    }
};

export default Report;
