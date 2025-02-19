import axios from "axios";
import AppUrl from "./AppURL";
import store from "../state/store";

var token = store.getState().user.token;

const axiosInstanceConfig = {
    baseURL: AppUrl.BaseURL,
    headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
    },
};
if (token != "") {
    axiosInstanceConfig.headers["Authorization"] = `Bearer ${token}`;
}
store.subscribe(() => {
    const newToken = store.getState().user.token;
    axiosInstance.defaults.headers["Authorization"] = newToken
        ? `Bearer ${newToken}`
        : null;
});
export const axiosInstance = axios.create(axiosInstanceConfig);
