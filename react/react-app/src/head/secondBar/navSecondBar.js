import React from 'react';

import OrderContainer from "./orderContainer";
import StatusContainer from "./statusContainer";


export default class NavSecondBar extends React.Component {
    constructor(props) {
        super(props);
     
        this.state = {

        };
   
      }



render(){

    return(
        <div className="navMainSecondBar">

        <OrderContainer order={this.props.order} changeOrder={this.props.changeOrder} />
        <StatusContainer status={this.props.status} changeStatus={this.props.changeStatus}/>
        
        </div>
    )
}




}