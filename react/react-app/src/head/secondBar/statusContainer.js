import React from 'react';
import OrderMenuItems from './order';



export default class StatusContainer extends React.Component {
    constructor(props) {
        super(props);
     
        this.state = {
            dropDownOrderBool : false

        };
   
      }


      dropDownItems(){
        this.setState({
          dropDownOrderBool : !this.state.dropDownOrderBool
        });
    }


render(){

    return(
        <div className="orderContainer">
        <div className="orderTag">STATUS</div>
        


            <div className="orderMenu">
                    <div className="chosenOrderContainer" onClick={() => this.dropDownItems()}>                    
                        <div className="chosenOrderText">
                            {this.props.status ? "RELEASED" : "UNRELEASED"}
                        </div>
                    </div>
                {this.state.dropDownOrderBool ? <OrderMenuItems values={["RELEASED","UNRELEASED"]} handler={ this.props.changeStatus} /> : ""}
            </div>



            
        </div>
        
    )
}




}