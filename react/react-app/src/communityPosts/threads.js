import React from "react";



export default class Threads extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
    };
  

  }





  render() {
    return (


<div class="right_cont">
                
                <div class="smaller_cont">
                <h3 class="cat_head">Threads</h3>
                        <ul class="list_category">
                                <li><a class="" href="/" >All</a></li>
                                <li><a class="" href="/thread/Books/" >Books</a></li>
                                <li><a class="" href="/thread/Tvshow/" >TV show</a></li>
                                
                                <li><a class="" href="/thread/Movies/" >Movies</a></li>
                                <li><a class="" href="/thread/Events/" >Events</a></li>
                                <li><a class="" href="/thread/Gaming/" >Gaming</a></li>
                                <li><a class="" href="/thread/Sport/" >Sport</a></li>

                        </ul>

                </div>
               

        </div>
    );
  }
}




