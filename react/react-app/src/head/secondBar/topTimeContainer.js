import React from 'react';
import arrowDown from '../../img/dsign.svg';
//import hot from '../../img/popular.svg';
import OrderMenuItems from './order';


export default class TopTimeContainer extends React.Component {
    constructor(props) {
        super(props);
     
        this.state = {
            dropDownOrderBool : false

        };
        this.dropDownItems = this.dropDownItems.bind(this);
      }

      dropDownItems(){
        this.setState({
          dropDownOrderBool : !this.state.dropDownOrderBool
        });
    }


render(){

    return(
       

        
        <div className="orderContainer">
            <div className="orderTag">TIME</div>
            


                <div className="orderMenu">
                        <div className="chosenOrderContainer" onClick={() => this.dropDownItems()}>                    
                            <div className="chosenOrderText">
                                {this.props.interval}

                            </div>
                            <img className="arrowDown" src={arrowDown} alt="icon"/>
                        </div>

                        {this.state.dropDownOrderBool ? <OrderMenuItems values={["DAY","WEEK","MONTH","YEAR","ALL"]} handler={ this.props.changeInterval} dropDownHandler={this.dropDownItems}/> : ""}
                </div>



                
            </div>
       

      
    )
}




}