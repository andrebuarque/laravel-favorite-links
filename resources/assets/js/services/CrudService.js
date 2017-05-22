class CrudService {
  static get URL() {
    return '';
  }

  static get OPTIONS() {
    return {
      headers: {
        'X-CSRF-Token': window.Laravel.csrfToken,
        'Content-Type': 'application/json; charset=UTF-8'
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

  static edit(id, data, success, error) {
    const params = Object.assign({}, this.OPTIONS, {method: 'PUT', body: data});

    fetch(`${this.URL}/${id}`, params)
      .then(this.handleError)
      .then(success)
      .catch(error);
  }

  static store(data, success, error) {
    const params = Object.assign({}, this.OPTIONS, {method: 'POST', body: data});

    fetch(this.URL, params)
      .then(this.handleError)
      .then(success)
      .catch(error);
  }

  static remove(id, success, error) {
    const params = Object.assign({}, this.OPTIONS, {method: 'DELETE'});

    fetch(`${this.URL}/${id}`, params)
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

export default CrudService;