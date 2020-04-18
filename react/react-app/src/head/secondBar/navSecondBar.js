import React from 'react';

import OrderContainer from "./orderContainer";
import StatusContainer from "./statusContainer";
import TopTimeContainer from "./topTimeContainer";

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
        { (this.props.order === "top") ?  <TopTimeContainer interval={this.props.interval} changeInterval={this.props.changeInterval} /> : ""}
        <StatusContainer status={this.props.status} changeStatus={this.props.changeStatus}/>
        
        </div>
    )
}




}