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
    this.listAll = this.listAll.bind(this);
  }

  componentDidMount() {
    this.listAll();
  }

  listAll() {
    TagService.all((data) => {
      this.setState({
        dataList: data
      });
    }, (data) => {
      alert('Ocorreu um erro: ' + data.message);
    });
  }

  actionsDataFormat(id) {
    const urlEdit = `/tags/edit/${id}`;

    return <BtnActions registryID={id} urlEdit={urlEdit} funcDelete={ this.deleteRow }/>;
  }

  deleteRow(id) {
    if (confirm(`Deseja excluir o registro ${id}?`)) {
      TagService.remove(id, () => {
        this.listAll();
      }, (err) => {
        alert('Ocorreu um erro: ' + err.message);
      });
    }
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
          <TableHeaderColumn dataField='title'>Título</TableHeaderColumn>
          <TableHeaderColumn 
            dataField='id' 
            width='100px'
            isKey
            dataFormat={ this.actionsDataFormat }>
            Ações
          </TableHeaderColumn>
        </BootstrapTable>
      </div>
		);
	}
}

export default Tags;