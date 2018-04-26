<style>
*{
  box-sizing: border-box;
}

html, body{
  margin: 0;
  border: 0;
  font-family: Arial, Helvetica, sans serif;
  color: #fff !important;
  background-color: #333 !important;
  overflow: hidden;
}

.landing{
  position: relative;
  background-image: url('uploads/bg.jpg');
  background-size: cover;
  background-position: center;
  height: 100vh;
}

.landing-inner{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  text-align: center;
}

.landing-inner p{
  font-size: 27px;
}

 /* Show the dropdown menu on hover */
.dropdown:hover .dropdown-menu {
    display: block;
    background: #f5f5f5;
    color: #000;
}

.dropdown .dropdown-menu a:hover {
    display: block;
    background: orange;
    color: #fff;
}

.login_form{
  width: 60%;
  height: auto;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #b0c4de;
  background: #f5f5f5;
  border-radius: 0px 0px 10px 10px;  
  animation-delay: .1s;
}

.error{
  width: 92%;
  margin: 0px auto;
  padding: 10px;
  color: #a94442;
  background: #f2dede;
  border-radius: 5px solid #a94442;;
  text-align: center;
}

.success{
  width: 92%;
  margin: 0px auto;
  padding: 10px;
  color: lightgreen;
  background: green;
  border-radius: 5px solid lightgreen;
  text-align: center;
}



@media(max-width: 650px)
{
  .landing img
  {
    width: 70%;
  }

.landing-inner{
  padding-top: 10px;
}

.landing-inner p{
  font-size: 17px;
}
}

  
</style>