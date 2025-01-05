export enum StepType {
    YEAR = 1,
    BRAND = 2,
}

export enum AttributeType {
    VEHICLE = 1,
    ITEM = 2,
    BOTH = 3,
}

export enum AttributeInput {
    TEXT = 1,
    NUMBER = 2,
    DATE = 3,
    SELECT = 4,
    RADIO = 5,
    CHECKBOX = 6,
}

export enum Fuel {
    PETROL = 1,
    LPG = 2,
    DIESEL = 3,
    ELECTRIC = 4,
    HYBRID = 5,
}

export enum Gear {
    MANUAL = 1,
    AUTOMATIC = 2,
    SEMI_AUTOMATIC = 3,
}

export enum ItemState {
    DRAFT = 1,
    PENDING = 2,
    REJECTED = 3,
    APPROVED = 4,
    PUBLISHED = 5,
    SOLD = 6,
    MODIFIED = 7,
    REMOVED_BY_USER = 8,
    REMOVED_BY_ADMIN = 9,
    OUTDATED = 10,
    DELETED = 11,
}

export enum PhotoState {
    UPLOADED = 1,
    APPROVED = 2,
    REJECTED = 3,
}

export enum UserState {
    PENDING = 1,
    ACTIVE = 2,
    CLOSED = 3,
}

export enum PageCategory {
    COMMERCIAL = 1,
    SERVICE = 2,
    PRIVACY = 3,
}

export enum BannerField {
    HOMEPAGE_SLIDER = 1,
}
