export interface IPanelList{
    id: string,   //collection.id
    name:string,
    photo_url:string,
    contrac: string,
    item_qty: string,
    market_cap:string,
    market_cap_p:string,
    volume_24:string,
    volume_24_p:number,
    sales_24:string,
    holders: string,
    holders_p: string,
    floor_price: string,
    floor_price_p:string,
    volume_7d:number,
    volume_7d_p:string,
    unit: string,
    avatar:string,
    nft_url: string,
}
export interface IInfo  {
    collection_name:string,
    contract: string,
    id: string,
    photo_url: string,
    token_id: string,
    nft_url:string,
}
export interface Login{
    holding_atl_nft: string;
    is_holder: number;
    status:string;
    token: string;
    username: string;
}