export interface IPanelList{
    id: string,   //collection.id
    name:string,
    photo_url:string,
    contrac: string,
    item_qty: string,
    market_cap:string,
    market_cap_p:string,
    volume_24:string,
    volume_24_p:string,
    sales_24:string,
    holders: string,
    holders_p: string,
    floor_price: string,
    floor_price_p:string,
    unit: string,
}
export interface IInfo  {
    background:string;
    collection_url: string;
    collection: string;
    introduction: string;
    price: string;
    ori_date: string;
}