import Api from './Api';

const Auth = {
    cachedUser: null,

    user: () => {
        return Auth.cachedUser;
    },

    check: () => {
        if (Auth.cachedUser) {
            return new Promise( (resolve) => {
                resolve({
                    data: Auth.cachedUser
                });
            });
        }

        let result = Api.get('/auth/current');

        result.then( ({ data }) => {
            Auth.cachedUser = data ? data : null;
        });

        return result;
    },

    login: (login, password) => {
        let result = Api.post('/auth/login', {login: login, password: password});

        result.then( ({ data }) => {
            Auth.cachedUser = data ? data : null;
        });

        return result;
    },

    logout: () => {
        let result = Api.get('/auth/logout');

        result.then(() => {
            Auth.cachedUser = null;
        });

        return result;
    },
};

export default Auth;
