//import liraries
import React from 'react';
import {ActivityIndicator, Dimensions, FlatList, StatusBar, StyleSheet} from 'react-native';
import {connect} from 'react-redux';
import TrackItem from '../../../components/Track/TrackItem';
import LinearGradient from 'react-native-linear-gradient';
import LibraryHeader from '../../../components/User/Library/Header';
import axios from 'axios';
import Animated, {Extrapolate} from 'react-native-reanimated';

class Tracks extends React.PureComponent {
    constructor(props) {
        super(props);
        this.state = {
            tracks: null,
            scrollY: new Animated.Value(0),
        };
        props.navigation.setOptions({
            title: 'Mes favoris',
        });
    }

    _get_tracks = (offset = 0) => {
        const promise = axios.get(`https://api.spotify.com/v1/me/tracks?offset=${offset}&limit=30`, {
            headers: {
                Accept: 'application/json',
                Authorization: 'Bearer ' + this.props.store.authentication.accessToken,
                'Content-Type': 'application/json',
            },
        });
        return promise.then(data => data.data);
    };

    componentDidMount() {
        this._get_tracks().then(data => this.setState({tracks: data.items}));
    }

    _get_liked_count = () => {
        return 1777;
    };

    render() {
        const scale = this.state.scrollY.interpolate({
            inputRange: [-Dimensions.get('screen').height, 0, 125],
            outputRange: [2, 1, 0.5],
            extrapolateRight: Extrapolate.CLAMP,
        });
        const opacity = this.state.scrollY.interpolate({
            inputRange: [0, 200],
            outputRange: [0, 1],
            extrapolate: Extrapolate.CLAMP,
        });
        const mb = this.state.scrollY.interpolate({
            inputRange: [0, 125],
            outputRange: [10, -75],
            extrapolate: Extrapolate.CLAMP,
        });

        const br = this.state.scrollY.interpolate({
            inputRange: [0, 10],
            outputRange: [0, 10],
            extrapolate: Extrapolate.CLAMP,
        });

        const height = this.state.scrollY.interpolate({
            inputRange: [0, 125],
            outputRange: [Dimensions.get('screen').width, Dimensions.get('screen').width],
            extrapolate: Extrapolate.CLAMP,
        });

        const mt = this.state.scrollY.interpolate({
            inputRange: [0, Dimensions.get('window').height * 10],
            outputRange: [Dimensions.get('screen').width, 0],
            extrapolate: Extrapolate.CLAMP,
        });

        const borderRadius = this.state.scrollY.interpolate({
            inputRange: [0, 125],
            outputRange: [0, 350],
            extrapolate: Extrapolate.CLAMP,
        });

        const transform = [{scale}];

        const ml = this.state.scrollY.interpolate({
            inputRange: [0, 125],
            outputRange: [StatusBar.currentHeight, 0],
            extrapolate: Extrapolate.CLAMP,
        });

        return (
            <LinearGradient
                colors={['#15202B', '#15202B']}
                style={{...styles.container}}>
                <LibraryHeader y={this.state.scrollY} />
                <Animated.ScrollView style={{zIndex: 98}} onScroll={Animated.event(
                    [{nativeEvent: {contentOffset: {y: this.state.scrollY}}}],
                    {listener: '', useNativeDriver: true},
                )}>
                    <Animated.View style={{marginTop: mt, backgroundColor: '#15202B'}}>
                        <FlatList
                            data={this.state.tracks}
                            scrollEnabled={true}
                            horizontal={false}
                            style={{paddingTop: StatusBar.currentHeight}}
                            contentContainerStyle={{paddingBottom: 150}}
                            onEndReachedThreshold={0.9}
                            onEndReached={() => {
                                this._get_tracks(this.state.tracks.length - 1).then(data => {
                                    this.setState({
                                        tracks: [...this.state.tracks, ...data.items],
                                    });
                                });
                            }}
                            ListFooterComponent={() => (
                                <ActivityIndicator size={'large'}/>
                            )}
                            keyExtractor={(item) => item.track?.id}
                            renderItem={({item}) => (
                                <TrackItem
                                    track={item.track}
                                    album={item?.track?.album}
                                    favorites={true}
                                />
                            )}
                        />
                    </Animated.View>
                </Animated.ScrollView>
            </LinearGradient>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: '#1E2732',
    },
});

const mapStateToProps = store => {
    return {
        store: store,
    };
};

export default connect(mapStateToProps)(Tracks);
