import React, { Component } from 'react';
import { Link } from 'react-router';

import { BootstrapTable, TableHeaderColumn } from 'react-bootstrap-table';

import PageHeader from '../layout/PageHeader';
import BtnActions from '../BtnActions';
import TagService from '../../services/TagService';

class Tags extends Component {
  constructor(props) {
    super(props);

    this.state = {
      dataList: []
    };

    this.actionsDataFormat = this.actionsDataFormat.bind(this);
    this.deleteRow = this.deleteRow.bind(this);
  }

  componentDidMount() {
    TagService.all((data) => {
      this.setState({
        dataList: data
      });
    }, (data) => {
      alert('Ocorreu um erro: ' + data.message);
    });
  }

  componentWillReceiveProps(nextProps) {
    console.log(nextProps);
  }

  actionsDataFormat(cell, row) {
    const urlEdit = `/tags/edit/${cell}`;

    return <BtnActions registryID={cell} urlEdit={urlEdit} funcDelete={ this.deleteRow }/>;
  }

  deleteRow(id) {
    return;
  }

	render() {
		return (
			<div>
        <PageHeader title="Tags" />

        <Link to="/tags/create" className="btn btn-primary" style={{ marginTop: '15px' }}>
          <i className="glyphicon glyphicon-plus"/> Nova tag
        </Link>

        <BootstrapTable 
          data={this.state.dataList}
          striped 
          hover
          pagination
          containerStyle={{ marginTop: '15px' }}>
          <TableHeaderColumn isKey dataField='id'>ID</TableHeaderColumn>
          <TableHeaderColumn dataField='title'>Título</TableHeaderColumn>
          <TableHeaderColumn 
            dataField='id' 
            dataFormat={ this.actionsDataFormat }>
            Ações
          </TableHeaderColumn>
        </BootstrapTable>
      </div>
		);
	}
}

export default Tags;