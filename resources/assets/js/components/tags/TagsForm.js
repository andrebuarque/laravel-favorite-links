import React, {Component} from 'react';
import {Link} from 'react-router';

class TagsForm extends Component {
  render() {
    const {callbackSave, handleInputChange, title} = this.props;

    return (
      <div>
        <form onSubmit={callbackSave}>

          <div className="form-group">
            <label htmlFor="title">Título</label>
            <input type="text" className="form-control" name="title" value={title} placeholder="Título" onChange={handleInputChange}/>
          </div>

          <button type="submit" className="btn btn-default">Salvar</button>

          <Link to="/tags" className="btn btn-default" style={{marginLeft: '5px'}}>
            Voltar
          </Link>

        </form>
      </div>
    );
  }
}

TagsForm.propTypes = {
  callbackSave: React.PropTypes.func.isRequired,
  handleInputChange: React.PropTypes.func.isRequired
};

export default TagsForm;