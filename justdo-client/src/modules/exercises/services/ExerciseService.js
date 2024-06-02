const url = "http://justdo.michiel/api";

export default class ExerciseService {
    constructor() {
        this.language = "en";
    }

    setLanguage(language) {
        this.language = language;
        return this;
    }

    async getAllExercises(language) {
        let fullUrl = `${url}/exercises/list?language=${language}`;

        const response = await fetch(fullUrl);
        const data = await response.json();
        return data;
    }

    async getExercisesById(language) {
        let id = '';
        let token = '';
        try {
            id = localStorage.getItem("user_id");
            token = localStorage.getItem("token");
        } catch (error) {
            return error;
        }
        let fullUrl = `${url}/users/${id}/exercises?language=${language}`;

        const response = await fetch(fullUrl, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
        });
        try {
            const data = await response.json();
            return data;
        } catch (error) {
            return null;
        }
    }

    async addExercise(exercise_id, reps) {
        let user_id = '';
        let token = '';
        try {
            user_id = localStorage.getItem("user_id");
            token = localStorage.getItem("token");
        } catch (error) {
            return error;
        }

        const response = await fetch(`${url}/users/${user_id}/exercises/${exercise_id}/reps/${reps}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
        });

        const data = await response.json();
        return data;
    }

    async editExercise(exercise_id, reps) {
        let user_id = '';
        let token = '';
        try {
            user_id = localStorage.getItem("user_id");
            token = localStorage.getItem("token");
        } catch (error) {
            return error;
        }

        const response = await fetch(`${url}/users/${user_id}/exercises/${exercise_id}/reps/${reps}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
        });

        const data = await response.json();
        return data;
    }

    async deleteExercise(exercise_id) {
        let user_id = '';
        let token = '';
        try {
            user_id = localStorage.getItem("user_id");
            token = localStorage.getItem("token");
        } catch (error) {
            return error;
        }

        const response = await fetch(`${url}/users/${user_id}/exercises/${exercise_id}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
        });

        const data = await response.json();
        return data;
    }
}