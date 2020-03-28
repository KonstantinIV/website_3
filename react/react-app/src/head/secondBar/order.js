import React from 'react';


export default class OrderMenuItems extends React.Component{


    render(){
        return (
    <div className="menuOrders">


        {this.props.values.map( element => (

        <div className="order" onClick={() => this.props.handler(element)}>{element}</div>

        ))}
        
    </div>
        )
    }
}