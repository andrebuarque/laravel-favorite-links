import React, { Component } from 'react';
import { Link } from 'react-router';

import { BootstrapTable, TableHeaderColumn } from 'react-bootstrap-table';

import PageHeader from '../layout/PageHeader';
import BtnActions from '../BtnActions';
import LinkService from '../../services/LinkService';

class Links extends Component {
  constructor(props) {
    super(props);
  
    this.state = {
      dataList: []
    };

    this.actionsDataFormat = this.actionsDataFormat.bind(this);
    this.formatTagsColumn = this.formatTagsColumn.bind(this);
    this.formatTitleColumn = this.formatTitleColumn.bind(this);
    this.deleteRow = this.deleteRow.bind(this);
    this.listAll = this.listAll.bind(this);
  }

  listAll() {
    LinkService.all((data) => {
      this.setState({
        dataList: data
      });
    }, (data) => {
      alert('Ocorreu um erro: ' + data.message);
    });
  }

  deleteRow(id) {
    if (confirm(`Deseja excluir o registro ${id}?`)) {
      LinkService.remove(id, () => {
        this.listAll();
      }, (err) => {
        alert('Ocorreu um erro: ' + err.message);
      });
    }
  }

  actionsDataFormat(cell) {
    const urlEdit = `/links/edit/${cell}`;

    return <BtnActions registryID={cell} urlEdit={urlEdit} funcDelete={ this.deleteRow }/>;
  }

  formatTagsColumn(tags) {
    return tags.map((tag) => tag.title).join(", ");
  }

  formatTitleColumn(cell, row) {
    return <a href={row.url} target="_blank">{row.title}</a>;
  }

  componentDidMount() {
    this.listAll();
  }

	render() {
		return (
			<div>
        <PageHeader title="Links" />

        <Link to="/links/create" className="btn btn-primary" style={{ marginTop: '15px' }}>
          <i className="glyphicon glyphicon-plus"/> Novo link
        </Link>

        <BootstrapTable 
          data={this.state.dataList} 
          striped 
          hover
          pagination
          containerStyle={{ marginTop: '15px' }}>
          <TableHeaderColumn dataFormat={this.formatTitleColumn} dataField='title'>Link</TableHeaderColumn>
          <TableHeaderColumn dataFormat={this.formatTagsColumn} dataField='tags'>Tags</TableHeaderColumn>
          <TableHeaderColumn 
            dataField='id' isKey
            width='100px'
            dataFormat={ this.actionsDataFormat }>
            Ações
          </TableHeaderColumn>
        </BootstrapTable>
      </div>
		);
	}
}

export default Links;