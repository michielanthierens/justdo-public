const url = 'http://justdo.michiel/api'

export default class FituserService {
    constructor() {}

    async login(name, password) {
        try {
          const response = await fetch(url + '/login', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name: name, password: password })
          });
      
          if (!response.ok) {
            throw new Error('Failed to login');
          } 
      
          const data = await response.json();
          return data;
        } catch (error) {
          throw error;
        }
      }
      

    async register(name, password) {
        try {
            const response = await fetch(url + '/register', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify({ name: name, password: password })
            });
        
            if (!response.ok) {
              throw new Error('Failed to register');
              
            } 
        
            const data = await response.json();
            return data;
          } catch (error) {
            throw error;
          }
    }

    async logout() {
        fetch(url + '/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ token: localStorage.getItem('token') })
        })
            .then(response => response.json())
            .then(data => {
                return data
            })
            .catch((error) => {
            });
    }

    async refresh() {
        fetch(url + '/refresh', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ token: localStorage.getItem('token') })
        })
            .then(response => response.json())
            .then(data => {
                return data
            })
            .catch((error) => {
            });
    }
}
