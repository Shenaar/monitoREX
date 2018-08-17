import Api from './Api';

const Auth = {
    cachedUser: null,

    user: () => {
        return Auth.cachedUser;
    },

    check: () => {
        if (Auth.cachedUser) {
            return new Promise((resolve) => {
                resolve({
                    data: Auth.cachedUser
                });
            });
        }

        let result = Api.get('/auth/current');

        result.then((response) => {
            Auth.cachedUser = response.data ? response.data : null;
        });

        return result;
    },
};

export default Auth;
