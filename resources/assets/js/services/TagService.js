import CrudService from './CrudService';

class TagService extends CrudService {
  static get URL() {
    return '/tags';
  }
}

export default TagService;