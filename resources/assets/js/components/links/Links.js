import React, { Component } from 'react';
import { Link } from 'react-router';

import { BootstrapTable, TableHeaderColumn } from 'react-bootstrap-table';

import PageHeader from '../layout/PageHeader';
import BtnActions from '../BtnActions';

class Links extends Component {
	render() {
		return (
			<div>
        <PageHeader title="Links" />

        <Link to="/links/create" className="btn btn-primary" style={{ marginTop: '15px' }}>
          <i className="glyphicon glyphicon-plus"/> Novo link
        </Link>

        <BootstrapTable 
          data={[{
              id: 1,
              title: "Title1",
              url: 'http://allenfang.github.io/react-bootstrap-table/custom.html#insertmodal',
              tags: 'react, es6'
          }, {
              id: 2,
              title: "Title2",
              url: 'https://github.com/AllenFang/react-bootstrap-table/',
              tags: 'react, es6'
          }]} 
          striped 
          hover
          pagination
          containerStyle={{ marginTop: '15px' }}>
          <TableHeaderColumn isKey dataField='id'>ID</TableHeaderColumn>
          <TableHeaderColumn dataField='title'>Título</TableHeaderColumn>
          <TableHeaderColumn dataField='url'>URL</TableHeaderColumn>
          <TableHeaderColumn dataField='tags'>Tags</TableHeaderColumn>
          <TableHeaderColumn 
            dataField='id' 
            dataFormat={ (cell, row) => <BtnActions registryID={cell} urlEdit={`/links/edit/${cell}`} funcDelete={(id) => { return; }} /> }>
            Ações
          </TableHeaderColumn>
        </BootstrapTable>
      </div>
		);
	}
}

export default Links;