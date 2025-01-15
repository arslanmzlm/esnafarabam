export interface EnumResponse {
    name: string;
    label: string;
    value: number;
}

export interface AttributeInputEnumResponse {
    name: string;
    label: string;
    value: number;
    hasValues: boolean;
}

export interface AttributeValueResponse {
    id: number | null;
    attribute_id: number;
    value: any;
}

export interface AttributeViewResponse {
    categoryName: string;
    tableAttributes: {
        name: string;
        value: string | Array<any>;
    }[];
    checkboxAttributes: {
        name: string;
        value: Array<string>;
    }[];
}

export interface SettingsResponse {
    [key: string]: any;
}
