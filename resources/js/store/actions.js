import UserProvider from "../providers/User";

const UserResource = new UserProvider();

export const SET_CURRENT_USER = ({ commit }, jwt) => {
    return new Promise((resolve, reject) => {
        UserResource.getCurrentUser()
            .then((user) => {
                let data_user = user.data;
                commit("SET_CURRENT_USER", {
                    user: {
                        id: data_user.id,
                        full_name: data_user.profile.name + " " + data_user.profile.last_name,
                        email: data_user.email,
                        level: data_user.level,
                        vendor_id: data_user.vendor_id,
                        profile: data_user.profile,
                    },
                });
                return true;
            })
            .then(() => {
                resolve(true);
            })
            .catch((err) => {
                reject(err);
            });
    });
};