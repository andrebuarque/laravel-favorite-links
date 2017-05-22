import React, { Component } from 'react';

import PageHeader from '../layout/PageHeader';
import Form from './LinksForm';
import LinkService from '../../services/LinkService';

class LinksEdit extends Component {
  constructor(props) {
    super(props);
  
    this.state = {
      title: '',
      url: '',
      tags: []
    };

    this.handleInputChange = this.handleInputChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleInputChange(event) {
    if (('length' in event)) {
      this.setState({
        tags: event
      });

      return;
    }

    const target = event.target;

    this.setState({
      [target.name]: target.value
    });
  }

  handleSubmit(event) {
    event.preventDefault();

    const id = this.props.params.id;

    const data = this.state;
    data.tags = data.tags.map((tag) => tag.id);

    LinkService.edit(id, JSON.stringify(data),
      (response) => {
        location.href = '#/';
      }, (error) => {
        alert(`Houve um problema ao editar o link. ${error}`);
      });
  }

  componentWillMount() {
    const id = this.props.params.id;

    LinkService.get(id, (data) => {
      this.setState({ 
        title: data.title,
        url: data.url,
        tags: data.tags
      });
    }, (err) => {
      alert(`Erro ao buscar informações do link. ${err.message}`);
    });
  }

	render() {
		return (
			<div>
        <PageHeader title="Editar link" />

        <div style={{ marginTop: '15px' }}>
          <Form 
              handleInputChange={this.handleInputChange} 
              callbackSave={this.handleSubmit} 
              title={this.state.title}
              url={this.state.url}
              tags={this.state.tags}
          />
        </div>
      </div>
		);
	}
}

export default LinksEdit;