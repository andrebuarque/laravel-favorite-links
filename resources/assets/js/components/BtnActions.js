import React, {Component} from 'react';
import {Link} from 'react-router';

class BtnActions extends Component {
  constructor(props) {
    super(props);

    this.delete = this.deleteRow.bind(this);
  }

  deleteRow() {
    const {registryID, funcDelete} = this.props;

    funcDelete(registryID);
  }

  render() {
    const urlEdit = this.props.urlEdit;
    return (
      <div>
        <Link to={urlEdit} className="btn btn-info btn-sm">
          <i className="glyphicon glyphicon-pencil"/>
        </Link>
        <a href="javascript:void(0);" className="btn btn-danger btn-sm" onClick={this.delete} style={{marginLeft: '5px'}}>
          <i className="glyphicon glyphicon-remove"/>
        </a>
      </div>
    );
  }
}

export default BtnActions;