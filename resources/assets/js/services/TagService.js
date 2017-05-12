class TagService {
  static get URL() {
    return '/tags';
  }

  static get OPTIONS() {
    return {
      headers: {
        'X-CSRF-Token': window.Laravel.csrfToken
      },
      credentials: 'include'
    };
  }

  static all(success, error) {
    fetch(this.URL, this.OPTIONS)
      .then(this.handleError)
      .then(success)
      .catch(error);
  }

  static get(id, success, error) {
    fetch(`${this.URL}/${id}`, this.OPTIONS)
      .then(this.handleError)
      .then(success)
      .catch(error);
  }

  static store(data, success, error) {
    fetch(this.URL, Object.assign({}, this.OPTIONS, {method: 'POST', body: data}))
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

export default TagService;