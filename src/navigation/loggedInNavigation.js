
import React, {useContext} from 'react';
import {Linking, View, Text, Button} from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Icon from 'react-native-vector-icons/FontAwesome5';

import {ReactReduxContext, connect} from 'react-redux';

import MyFavoriteMusicScreen from "../screens/MyFavoriteMusic/MyFavoriteMusicScreen"
import MyProfileScreen from "../screens/MyProfile/MyProfileScreen"

import HomeScreen from './../screens/Home/HomeScreen';
import Category from './../screens/Category/CategoryScreen';
import Album from './../screens/Album/AlbumScreen';
import Artist from './../screens/Artist/ArtistScreen';
import Track from './../screens/Track/TrackScreen';
import Playlist from './../screens/Playlist/PlaylistScreen';

export const config = {
  screens: {
    Home: {
      path: 'home',
    },
    Settings: {
      path: 'callback'
    },
    Test: {
      path: 'test'
    },
    Category: {
      path: 'category'
    },
    Playlist: {
      path: 'playlist'
    },
    Album: {
      path: 'album'
    },
    Track: {
      path: 'track'
    },
    Artist: {
      path: 'artist'
    }
  }
}

const Tab = createBottomTabNavigator();

function LoggedInNavigation(props) {

    const {store} = useContext(ReactReduxContext);

    console.log(store.getState().authentication.accessToken)

    function HomeComponent(accessToken){
      return (
          <HomeScreen accessToken={accessToken} />
      )
    }

    function SettingsScreen({ navigation }) {
        return (
        <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
            <Text>Settings!</Text>
            <Button title="Go to Home" onPress={() => navigation.navigate('Home')} />
        </View>
        );
    }

    function TestScreen({ navigation }) {
        return (
        <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
            <Text>Test !</Text>
            <Button title="Go to Home" onPress={() => navigation.navigate('Home')} />
        </View>
        );
    }

    const Tab = createBottomTabNavigator();

    const Stack = createNativeStackNavigator();


    function NavigationStack()
    {
        return(
        <Stack.Navigator screenOptions={{
            gestureEnabled: true
        }}>
            <Stack.Screen options={{
            transitionSpec: {
                open: config,
                close: config
            }
            }} name="Home" component={HomeComponent} />
            <Stack.Screen name="Settings" component={SettingsScreen} />
            <Stack.Screen name="Category" component={Category} />
            <Stack.Screen name="Album" component={Album} />
            <Stack.Screen name="Artist" component={Artist} />
            <Stack.Screen name="Track" component={Track} />
            <Stack.Screen name="Playlist" component={Playlist} />
        </Stack.Navigator>
        )
    }

  return (
    <NavigationContainer>
        <Tab.Navigator
            screenOptions={({ route }) => ({
              tabBarIcon: ({ focused, color, size }) => {
                let iconName;

                if (route.name === 'Welcome') {
                  iconName = focused
                    ? 'home'
                    : '';
                } else if (route.name === 'Test') {
                  iconName = focused ? 'glass' : 'glass';
                }
                return <Icon name={'comments'} size={size} color={color} />;
              },
              tabBarActiveTintColor: 'tomato',
              tabBarInactiveTintColor: 'gray',
              gestureEnabled: true,
            })}
          >
            <Tab.Screen name="Welcome" component={NavigationStack} options={{
              headerShown: false
            }}/>
            <Tab.Screen name="Test" component={TestScreen} />
          </Tab.Navigator>
      </NavigationContainer>
  );
}

const mapStateToProps = store => {
      return {
        props: store.props
      }
    }

export default connect(mapStateToProps)(LoggedInNavigation)