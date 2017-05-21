import CrudService from './CrudService';

class LinkService extends CrudService {
  static get URL() {
    return '/links';
  }

}

export default LinkService;