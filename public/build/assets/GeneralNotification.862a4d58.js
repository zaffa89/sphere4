import{o as s,k as l,b as e,c as a,u as i,y as r,v as o,l as c,ai as u}from"./app.1031c8d8.js";import{r as m,a as h,b as f,c as g}from"./index.1bb25f75.js";const x={class:"pointer-events-auto w-full max-w-sm overflow-hidden rounded-t-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"},y={class:"p-4"},w={class:"flex items-start"},v={class:"flex-shrink-0"},_={class:"ml-3 w-0 flex-1 pt-0.5"},k={class:"text-sm font-medium text-gray-900"},b={class:"mt-1 text-sm text-gray-500"},p={class:"ml-4 flex flex-shrink-0"},$={class:"overflow-hidden rounded-none"},B={props:["data"],emits:["dismiss"],data(){return{timer:0,duration:3}},watch:{timer:{handler(t){t<100?setTimeout(()=>{this.timer=this.timer+1/this.duration},10):this.$emit("dismiss",this.data.id)},immediate:!0}}},S=Object.assign(B,{__name:"GeneralNotification",setup(t){return(n,d)=>(s(),l("div",x,[e("div",y,[e("div",w,[e("div",v,[t.data.type==="success"?(s(),a(i(m),{key:0,class:"h-6 w-6 text-green-400","aria-hidden":"true"})):r("",!0),t.data.type==="warning"?(s(),a(i(h),{key:1,class:"h-6 w-6 text-yellow-400","aria-hidden":"true"})):r("",!0),t.data.type==="error"?(s(),a(i(f),{key:2,class:"h-6 w-6 text-red-400","aria-hidden":"true"})):r("",!0)]),e("div",_,[e("p",k,o(t.data.title),1),e("p",b,o(t.data.text),1)]),e("div",p,[e("button",{type:"button",class:"inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",onClick:d[0]||(d[0]=N=>n.$emit("dismiss",t.data.id))},[c(i(g),{class:"h-5 w-5","aria-hidden":"true"})])])])]),e("div",$,[e("div",{class:"h-1 rounded-none bg-blue-600",style:u("width: "+(100-n.timer)+"%")},null,4)])]))}});export{S as default};