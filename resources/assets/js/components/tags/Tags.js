import React, { Component } from 'react';
import { Link } from 'react-router';

import { BootstrapTable, TableHeaderColumn } from 'react-bootstrap-table';

import PageHeader from '../layout/PageHeader';
import BtnActions from '../BtnActions';

class Tags extends Component {
  constructor(props) {
    super(props);
  }

	render() {
		return (
			<div>
        <PageHeader title="Tags" />

        <Link to="/tags/create" className="btn btn-primary" style={{ marginTop: '15px' }}>
          <i className="glyphicon glyphicon-plus"/> Nova tag
        </Link>

        <BootstrapTable 
          data={[{
              id: 1,
              title: "Tag 1"
          }, {
              id: 2,
              title: "Tag 2"
          }]} 
          striped 
          hover
          pagination
          containerStyle={{ marginTop: '15px' }}>
          <TableHeaderColumn isKey dataField='id'>ID</TableHeaderColumn>
          <TableHeaderColumn dataField='title'>Título</TableHeaderColumn>
          <TableHeaderColumn 
            dataField='id' 
            dataFormat={ (cell, row) => <BtnActions registryID={cell} urlEdit={`/tags/edit/${cell}`} funcDelete={(id) => { return; }} /> }>
            Ações
          </TableHeaderColumn>
        </BootstrapTable>
      </div>
		);
	}
}

export default Tags;