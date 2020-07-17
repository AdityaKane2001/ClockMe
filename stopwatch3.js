var time = 0;
var running = 0;
function startPause(){
    if(running == 0){
        running = 1;
        increment();
    document.getElementById("start").innerHTML = "Pause";
    var d1 = new Date();                                         //new Date function date in Javascript                                       
    document.getElementById("start_time").value = d1.getUTCHours() +" : "+ d1.getUTCMinutes() +" : "+ d1.getUTCSeconds();//Pushing the value of start time to hidden input
    console.log(d1.getTime())
    console.log( d1.getUTCHours() +" : "+ d1.getUTCMinutes() +" : "+ d1.getUTCSeconds()); 
    console.log( d1.toUTCString())
    //all the consoles  above are for inspection purpose.They can be removed according to need.
    }
    else{
        running = 0;
        reset()
    }
}
//Reset function but it is treated as Pause function
function reset(){
    running = 0;
    time = 0;
    document.getElementById("start").innerHTML = "Start";
    document.getElementById("output").innerHTML = "0:00:00";
    var d1 = new Date();
    document.getElementById("end_time").value = d1.getUTCHours() +" : "+ d1.getUTCMinutes() +" : "+ d1.getUTCSeconds();
    console.log(d1.getTime())
    console.log( d1.getUTCHours() +" : "+ d1.getUTCMinutes() +" : "+ d1.getUTCSeconds());
    console.log( d1.toUTCString())
}

//Increment function
function increment(){
    if(running == 1){
        setTimeout(function(){
            time++;
            var mins = Math.floor(time/10/60);
            var secs = Math.floor(time/10 % 60);
            var hours = Math.floor(time/10/60/60);
            var tenths = 0;
            if(mins < 10){
                mins = "0" + mins;
            }
            if(secs < 10){
                secs = "0" + secs;
            }
            document.getElementById("output").innerHTML = hours + ":" + mins + ":" + secs ;
            increment();
        },100)
    }
}












//Javascript for another one

var time = 0;
var running = 0;
function startPause1(){
    if(running == 0){
        running = 1;
        increment1();
    document.getElementById("start1").innerHTML = "Pause";
    var d1 = new Date();                                         //new Date function date in Javascript                                       
    document.getElementById("start_time1").value = d1.getUTCHours() +" : "+ d1.getUTCMinutes() +" : "+ d1.getUTCSeconds();//Pushing the value of start time to hidden input
    console.log(d1.getTime())
    console.log( d1.getUTCHours() +" : "+ d1.getUTCMinutes() +" : "+ d1.getUTCSeconds()); 
    console.log( d1.toUTCString())
    //all the consoles  above are for inspection purpose.They can be removed according to need.
    }
    else{
        running = 0;
        reset1()
    }
}
//Reset function but it is treated as Pause function
function reset1(){
    running = 0;
    time = 0;
    document.getElementById("start1").innerHTML = "Start";
    document.getElementById("output1").innerHTML = "0:00:00";
    var d1 = new Date();
    document.getElementById("end_time1").value = d1.getUTCHours() +" : "+ d1.getUTCMinutes() +" : "+ d1.getUTCSeconds();
    console.log(d1.getTime())
    console.log( d1.getUTCHours() +" : "+ d1.getUTCMinutes() +" : "+ d1.getUTCSeconds());
    console.log( d1.toUTCString())
}

//Increment function
function increment1(){
    if(running == 1){
        setTimeout(function(){
            time++;
            var mins = Math.floor(time/10/60);
            var secs = Math.floor(time/10 % 60);
            var hours = Math.floor(time/10/60/60);
            var tenths = 0;
            if(mins < 10){
                mins = "0" + mins;
            }
            if(secs < 10){
                secs = "0" + secs;
            }
            document.getElementById("output1").innerHTML = hours + ":" + mins + ":" + secs ;
            increment1();
        },100)
    }
}

