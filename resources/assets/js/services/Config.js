import Api from './Api.js';

const Config = {
    get: () => {
        let keys = [
            'database.connections.mysql',
            'database.redis',
            'cache',
            'queue.default',
            'queue.connections',
        ];

        return Api.get('/config', { params: { keys: keys }});
    }
};

export default Config;
