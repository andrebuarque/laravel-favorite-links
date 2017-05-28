class UserService {
  static get OPTIONS() {
    return {
      headers: {
        'X-CSRF-Token': window.Laravel.csrfToken,
        'Content-Type': 'application/json; charset=UTF-8'
      },
      credentials: 'include'
    };
  }

  static getUserName(success, error) {
    fetch('/logged-user', this.OPTIONS)
      .then(this.handleError)
      .then(success)
      .catch(error);
  }

  static handleError(r) {
    if (!r.ok) {
      throw Error(`${r.status} - ${r.statusText}`);
    }
    return r.json();
  }
}

export default UserService;