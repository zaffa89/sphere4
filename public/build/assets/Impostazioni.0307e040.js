import{d as e,o as a,c as _,w as m,e as i,F as p,y as c,B as l,n as g,C as r,D as n,E as d,G as u}from"./app.e0b64a2d.js";import{A as h}from"./AppLayout.4431199f.js";import{_ as v}from"./AdminLayout.879301ae.js";import"./plugin-vue_export-helper.21dcd24c.js";const b=e("div",{class:"px-4 sm:px-6 md:px-0"},[e("h1",{class:"text-2xl font-bold tracking-tight text-gray-900"},"Impostazioni Sphere")],-1),y={class:"py-6"},f={class:"lg:hidden"},x=["selected"],k={class:"hidden lg:block"},w={class:"border-b border-gray-200"},z={class:"-mb-px flex space-x-8"},$=["onClick"],C={key:0,class:"py-6"},T=e("div",{class:"space-y-1"},[e("h3",{class:"text-lg font-medium leading-6 text-gray-900"},"Generale"),e("p",{class:"max-w-2xl text-sm text-gray-500"},"This information will be displayed publicly so be careful what you share.")],-1),M=e("div",{class:"mt-6"},null,-1),V=[T,M],B={key:1,class:"py-6"},G=e("div",{class:"space-y-1"},[e("h3",{class:"text-lg font-medium leading-6 text-gray-900"},"Calendario"),e("p",{class:"max-w-2xl text-sm text-gray-500"},"Impostazioni calendario e prenotazioni.")],-1),U={class:"mt-6"},D={class:"flex gap-5 mb-5 border p-6"},F=e("label",{for:"ora-inizio-agenda",class:"block text-sm font-medium text-gray-700"},"Orario inizio agenda",-1),I=e("option",{value:"5"},"5:00",-1),O=e("option",{value:"6"},"6:00",-1),S=e("option",{value:"7"},"7:00",-1),A=e("option",{value:"8"},"8:00",-1),E=e("option",{value:"9"},"9:00",-1),L=e("option",{value:"10"},"10:00",-1),N=e("option",{value:"11"},"11:00",-1),j=e("option",{value:"12"},"12:00",-1),q=[I,O,S,A,E,L,N,j],H=e("label",{for:"ora-fine-agenda",class:"block text-sm font-medium text-gray-700"},"Orario fine agenda",-1),J=e("option",{value:"13"},"13:00",-1),K=e("option",{value:"14"},"14:00",-1),P=e("option",{value:"15"},"15:00",-1),Q=e("option",{value:"16"},"16:00",-1),R=e("option",{value:"17"},"17:00",-1),W=e("option",{value:"18"},"18:00",-1),X=e("option",{value:"19"},"19:00",-1),Y=e("option",{value:"20"},"20:00",-1),Z=e("option",{value:"21"},"21:00",-1),ee=e("option",{value:"22"},"22:00",-1),oe=e("option",{value:"23"},"23:00",-1),te=[J,K,P,Q,R,W,X,Y,Z,ee,oe],se=e("label",{for:"durata-cella",class:"block text-sm font-medium text-gray-700"},"Durata cella calendario",-1),ae=e("option",{value:"5"},"5 Minuti",-1),ie=e("option",{value:"6"},"6 Minuti",-1),ne=e("option",{value:"10"},"10 Minuti",-1),le=e("option",{value:"15"},"15 Minuti",-1),re=e("option",{value:"20"},"20 Minuti",-1),de=e("option",{value:"30"},"30 Minuti",-1),pe=e("option",{value:"60"},"60 Minuti",-1),ce=[ae,ie,ne,le,re,de,pe],ue={class:"bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6 border"},_e={class:"text-sm font-medium text-gray-500"},me={class:"mt-1 text-sm text-gray-900 sm:col-span-1 sm:mt-0"},ge={class:"bg-white px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6 border"},he={class:"text-sm font-medium text-gray-500"},ve={class:"mt-1 text-sm text-gray-900 sm:col-span-1 sm:mt-0"},be={key:2,class:"py-6"},ye=e("div",{class:"space-y-1"},[e("h3",{class:"text-lg font-medium leading-6 text-gray-900"},"Colori"),e("p",{class:"max-w-2xl text-sm text-gray-500"},"This information will be displayed publicly so be careful what you share.")],-1),fe=e("div",{class:"mt-6"},null,-1),xe=[ye,fe],ke={layout:h,data(){return{tabs:["Generale","Calendario","Colori"],currentTab:"Generale"}},methods:{save(){axios.put("/api/sphere/save-setting/1",[{name:"Blu",code:"00F"}])}}},Ve=Object.assign(ke,{__name:"Impostazioni",setup(we){return(o,s)=>(a(),_(v,null,{default:m(()=>[b,e("div",y,[e("div",f,[e("select",{id:"selected-tab",onChange:s[0]||(s[0]=t=>o.currentTab=o.tab),name:"selected-tab",class:"mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-purple-500 focus:outline-none focus:ring-purple-500 sm:text-sm"},[(a(!0),i(p,null,c(o.tabs,t=>(a(),i("option",{key:t,selected:t==o.currentTab},l(t),9,x))),128))],32)]),e("div",k,[e("div",w,[e("div",z,[(a(!0),i(p,null,c(o.tabs,t=>(a(),i("button",{onClick:ze=>o.currentTab=t,key:t,class:g([t==o.currentTab?"border-purple-500 text-purple-600":"border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700","whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"])},l(t),11,$))),128))])])])]),o.currentTab=="Generale"?(a(),i("div",C,V)):r("",!0),o.currentTab=="Calendario"?(a(),i("div",B,[G,e("div",U,[e("div",D,[e("div",null,[F,n(e("select",{"onUpdate:modelValue":s[1]||(s[1]=t=>o.$page.props.settings.ora_minima_calendario.value=t),id:"ora-inizio-agenda",name:"ora-inizio-agenda",class:"mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"},q,512),[[d,o.$page.props.settings.ora_minima_calendario.value]])]),e("div",null,[H,n(e("select",{"onUpdate:modelValue":s[2]||(s[2]=t=>o.$page.props.settings.ora_massima_calendario.value=t),id:"ora-fine-agenda",name:"ora-fine-agenda",class:"mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"},te,512),[[d,o.$page.props.settings.ora_massima_calendario.value]])]),e("div",null,[se,n(e("select",{id:"durata-cella","onUpdate:modelValue":s[3]||(s[3]=t=>o.$page.props.settings.durata_cella_calendario.value=t),name:"durata-cella",class:"mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"},ce,512),[[d,o.$page.props.settings.durata_cella_calendario.value]])])]),e("div",ue,[e("dt",_e,l(o.$page.props.settings.colore_prenotazione_medsport.description),1),e("dd",me,[n(e("input",{type:"color","onUpdate:modelValue":s[4]||(s[4]=t=>o.$page.props.settings.colore_prenotazione_medsport.value=t)},null,512),[[u,o.$page.props.settings.colore_prenotazione_medsport.value]])])]),e("div",ge,[e("dt",he,l(o.$page.props.settings.colore_prenotazione_ambulatoriale.description),1),e("dd",ve,[n(e("input",{type:"color","onUpdate:modelValue":s[5]||(s[5]=t=>o.$page.props.settings.colore_prenotazione_ambulatoriale.value=t)},null,512),[[u,o.$page.props.settings.colore_prenotazione_ambulatoriale.value]])])])])])):r("",!0),o.currentTab=="Colori"?(a(),i("div",be,xe)):r("",!0)]),_:1}))}});export{Ve as default};
