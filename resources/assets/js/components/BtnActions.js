import React, {Component} from 'react';
import {Link} from 'react-router';

class BtnActions extends Component {
  render() {
    const {registryID, urlEdit, funcDelete} = this.props;
    return (
      <div>
        <Link to={urlEdit} className="btn btn-info btn-sm">
          <i className="glyphicon glyphicon-pencil"/>
        </Link>
        <Link to='#' className="btn btn-danger btn-sm" onClick={funcDelete(registryID)} style={{marginLeft: '5px'}}>
          <i className="glyphicon glyphicon-remove"/>
        </Link>
      </div>
    );
  }
}

export default BtnActions;