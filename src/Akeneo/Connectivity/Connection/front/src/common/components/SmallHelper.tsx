import React, {ReactNode} from 'react';
import styled from 'styled-components';
import infoIcon from '../assets/icons/info.svg';
import warningIcon from '../assets/icons/warning.svg';
import {PropsWithTheme} from '../theme';

interface Level {
    level: 'info' | 'warning';
}
const SubsectionHint = styled.div<Level>`
    align-items: center;
    background: ${(props: PropsWithTheme & Level) =>
        'info' === props.level ? props.theme.color.blue10 : props.theme.color.yellow10};
    display: flex;
    margin-bottom: 1px;
`;

const HintIcon = styled.div<Level>`
    background-image: url(${props => ('info' === props.level ? infoIcon : warningIcon)});
    background-position: center;
    background-repeat: no-repeat;
    background-size: 20px;
    flex-shrink: 0;
    height: 20px;
    margin: 12px;
    width: 20px;
`;

const HintTitle = styled.div`
    border-left: 1px solid ${({theme}: PropsWithTheme) => theme.color.grey80};
    flex-grow: 1;
    font-weight: 600;
    padding-left: 16px;
    margin: 10px 0;
    margin-right: 10px;
`;

type Props = {
    children: ReactNode;
    level?: 'info' | 'warning';
};

export const SmallHelper = ({children, level = 'info'}: Props) => (
    <SubsectionHint className='AknSubsection' level={level}>
        <HintIcon level={level} />
        <HintTitle>{children}</HintTitle>
    </SubsectionHint>
);
