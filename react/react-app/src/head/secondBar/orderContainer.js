import React from 'react';
import arrowDown from '../../img/dsign.svg';
import hot from '../../img/popular.svg';
import OrderMenuItems from './order';


export default class OrderContainer extends React.Component {
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
            <div className="orderTag">SORT</div>
            


                <div className="orderMenu">
                        <div className="chosenOrderContainer" onClick={() => this.dropDownItems()}>                    
                            <img className="hotIcon" src={hot} alt="icon"/>
                            <div className="chosenOrderText">
                                {this.props.order.toUpperCase()}

                            </div>
                            <img className="arrowDown" src={arrowDown} alt="icon"/>
                        </div>

                        {this.state.dropDownOrderBool ? <OrderMenuItems values={["HOT","TOP","NEW"]} handler={ this.props.changeOrder} dropDownHandler={this.dropDownItems}/> : ""}
                </div>



                
            </div>
       

      
    )
}




}