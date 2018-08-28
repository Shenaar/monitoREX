import Api from './Api.js';

const Project = {

    cache: {
        my: null
    },

    my() {
        if (this.cache.my) {
            return new Promise( (resolve) => {
                resolve({
                    data: this.cache.my
                });
            });
        }

        let result = Api.get('/projects/available');

        result.then( ({ data }) => {
            this.cache.my = data ? data : null;
        });

        return result;
    }
};

export default Project;
