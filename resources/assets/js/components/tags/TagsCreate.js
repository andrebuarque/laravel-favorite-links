import React, {Component} from 'react';

import PageHeader from '../layout/PageHeader';
import Form from './TagsForm';

import TagService from '../../services/TagService';

class TagsCreate extends Component {
  constructor(props) {
    super(props);

    this.state = {
      title: ''
    };

    this.handleInputChange = this.handleInputChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleInputChange(event) {
    const target = event.target;

    this.setState({
      [target.name]: target.value
    });
  }

  handleSubmit(event) {
    event.preventDefault();

    const data = {
      title: this.state.title
    };

    TagService.store(JSON.stringify(data),
      (response) => {
        location.href = '#/tags';
      }, (error) => {
        alert(`Houve um problema ao criar a tag. ${error}`);
      });
  }

  render() {
    return (
      <div>
        <PageHeader title="Nova tag"/>

        <div style={{marginTop: '15px'}}>
          <Form handleInputChange={this.handleInputChange} callbackSave={this.handleSubmit}/>
        </div>
      </div>
    );
  }
}

export default TagsCreate;